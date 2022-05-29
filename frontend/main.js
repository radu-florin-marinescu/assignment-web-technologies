window.onload = main;

async function main() {
  const res = await fetch("/api/data");
  const data = await res.json();
  const salesTotalsList = data.orders.map((sale) => sale.total);

  const salesRanges = {
  // sales = [range, actual]
    veryBigSales: [[15000, 20000], 0],
    bigSales: [[10000, 15000], 0],
    expectedSales: [[5000, 10000], 0],
    underExpectedSales: [[3000, 5000], 0],
    insolvencySales: [[1, 3000], 0],
  };


  for (const saleTotal of salesTotalsList) {
    for (const category in salesRanges) {
      const [[min, max], prevCount] = salesRanges[category];
      console.log(min,max, saleTotal)
      if (saleTotal >= min && saleTotal < max) {
        console.log("in if")
        salesRanges[category][1] = prevCount + 1;
      }
    }
  }

  const dataSet = [
    salesRanges.veryBigSales[1],
    salesRanges.bigSales[1],
    salesRanges.expectedSales[1],
    salesRanges.underExpectedSales[1],
    salesRanges.insolvencySales[1]
  ];

  const ctx = document.getElementById("chart").getContext("2d");
  const chart = new Chart(ctx, {
    type: "bar",
    data: {
      labels: ["> 15k", "10k-15k", "5k-10k", "3k-5k", "< 3k"],
      datasets: [
        {
          label: "Vânzări - valoare (RON)",
          // data: [12, 19, 3, 5, 2],
          data: dataSet,
          backgroundColor: [
            "rgba(255, 99, 132, 0.2)",
            "rgba(54, 162, 235, 0.2)",
            "rgba(255, 206, 86, 0.2)",
            "rgba(75, 192, 192, 0.2)",
            "rgba(153, 102, 255, 0.2)",
            "rgba(255, 159, 64, 0.2)",
          ],
          borderColor: [
            "rgba(255, 99, 132, 1)",
            "rgba(54, 162, 235, 1)",
            "rgba(255, 206, 86, 1)",
            "rgba(75, 192, 192, 1)",
            "rgba(153, 102, 255, 1)",
            "rgba(255, 159, 64, 1)",
          ],
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
}
