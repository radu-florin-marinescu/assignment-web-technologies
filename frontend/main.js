window.onload = main;

async function main() {
  const res = await fetch("/api/data");
  const data = await res.json();
  console.log(data);
  // console.log(await res.text());
}
