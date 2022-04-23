import java.sql.DriverManager.println
import java.text.SimpleDateFormat
import java.util.*
import kotlin.math.round
import kotlin.random.Random

// Acest script scris in Kotlin (Java modern) genereaza query-uri de INSERT aleatoare pentru a popula tabela de comenzi
// cu o cantitate semnificativa de date fara a le scrie manual


// Constante folosite in codul din accest script

// Capete generare data si ora aleatoare
private const val startPivotDate = 1644444000000
private const val endPivotDate = 1650722928211

// Capete generare suma aleatoare
private const val startPivotTotal = 200.00
private const val endPivotTotal = 20000.00

// Capete generare procent manopera aleatoare
private const val startPivotPercentage = 3.00
private const val endPivotPercentage = 60.00

// Capete generare cantitate produse aleatoare
private const val startPivotQuantity = 1
private const val endPivotQuantity = 20

// Formatul folosit pentru a genera data si ora
private const val dateFormat = "yyyy-MM-dd HH:mm"

// Alte constante
private const val doubleZero = 0.0
private const val mailSuffix = "@mail.com"
private const val charSpace = " "
private const val charPeriod = "."
private const val charNull = "NULL"

// Motive in cazul in care o comanda este pe status "Returned", selectia va fi aleatoare
val returnReasons = listOf(
    "Produsul este deteriorat",
    "Produsul nu este aferent calitatii descrise",
    "Produsul a venit incomplet",
    "Nu am primit produsul comandat",
    "Produsul nu contine instructiuni de utilizare",
)

// Metodele de plata posibile
enum class PaymentMethod {
    CASH,
    CARD
}

// Statusii posibili ai unei comenzi
enum class Status {
    RECEIVED,
    PROCESSING,
    SENT,
    COMPLETED,
    OUT_OF_STOCK,
    RETURNED
}

// Formatter-ul care traduce o data si ora din format Long (milisecunde unix), intr-un string
val format = SimpleDateFormat(dateFormat)

//(`id`, `client`, `total`, `date`, `payment`, `workmanship`, `workmanship_percentage`, `quantity`, `status`, `return_reason`)

fun main() {
    val result = generateRows(100)
    println(result.joinToString())
}

// Functia care genereaza query-urile de INSERT
fun generateRows(number: Int): List<String> {

    // Initializare lista editabila de query-uri, momentan goala
    val entries = mutableListOf<String>()

    // Generare date si ore aleatoare
    val dates = (1..number).map {
        Random.nextLong(startPivotDate, endPivotDate)
    }

    (1..number).forEachIndexed { index, _ ->
        // Generare nume aleator din lista de nume de mai jos
        val name = names.random()

        // Generare id unic de 32 de caractere
        val id = UUID.randomUUID().toString()

        // Transformare nume generat anterior intr-o adresa de email
        val client = name.lowercase().replace(charSpace, charPeriod) + mailSuffix

        // Generare pret total
        val total = Random.nextDouble(startPivotTotal, endPivotTotal).round(2)

        // Se sorteaza datele si orele generate mai devreme de la recent la vechi si se traduce data si ora aferenta indexului iteratiei curente
        val date = format.format(Date(dates.sortedByDescending { it }[index]))

        // Se genereaza o metoda de plata aleatoare
        val paymentMethod = PaymentMethod.values().random()

        // Se genereaza un boolean aferent manoperei
        val workmanship = Random.nextBoolean()

        // Se genereaza un procentaj pentru manopera, doar in cazul in care boolean-ul de manopera este true, altfel se seteaza pe 0.0
        val workmanshipPercentage = if (workmanship) {
            Random.nextDouble(startPivotPercentage, endPivotPercentage).round(2).toString()
        } else {
            doubleZero
        }

        // Se genereaza cantitate aleatoare
        val quantity = Random.nextInt(startPivotQuantity, endPivotQuantity)

        // Se genereaza status aleator
        val status = Status.values().random()

        // Se genereaza motiv retur aleator doar daca statusul comenzii este pe retur
        val returnReason: String? = if (status == Status.RETURNED) {
            returnReasons.random()
        } else {
            null
        }

        // Se genereaza query-ul si se adauga in lista
        val result =
            "(\'$id\', \'$client\', $total, \'$date\', \'$paymentMethod\', $workmanship, $workmanshipPercentage, $quantity, \'$status\', ${
                if (returnReason == null) {
                    charNull
                } else {
                    "'$returnReason'"
                }
            })"
        entries.add(result)
    }
    return entries
}

// Functie de rotunjire variabile de tip double la un numar exact de zecimale
fun Double.round(decimals: Int): Double {
    var multiplier = 1.0
    repeat(decimals) { multiplier *= 10 }
    return round(this * multiplier) / multiplier
}

// Lista de nume din care se aleg string-uri aleatoare
val names = listOf(
    "Gavril Vasiliu",
    "Tudor Niculescu",
    "Simion Mondragon",
    "Iuliu Cojocar",
    "Codrin Raducan",
    "Dragos Cantacuzino",
    "Dragomir Cutov",
    "Sanda Ciora",
    "Iuliu Cristea",
    "Petar Minea",
    "Danut Baicu",
    "Valentin Ungureanu",
    "Geza Vaduva",
    "Sanda Radu",
    "Ovidiu Iordache",
    "Stefan Proca",
    "Veaceslav Florea",
    "Vali Prunea",
    "Victor Breban",
    "Darius Tudor",
    "Ion Groza",
    "Ionache Enache",
    "Sandu Lupul",
    "Costel Raducioiu",
    "Danut Ilica",
    "Denis Lucescu",
    "Liviu Anghelescu",
    "Sanda Dimir",
    "Claudiu Dumitrescu",
    "Vali Macedonski",
    "Marin Florea",
    "Vasile Movila",
    "Costea Lupul",
    "Matei Lupescu",
    "Iulio Iacobescu",
    "Marius Vlaicu",
    "Liviu Vasiliu",
    "Robert Ene",
    "Teodor Silivasi",
    "Ilie Dragan",
    "Apostol Trelles",
    "Grigore Gogean",
    "Martin Izbasa",
    "Ferka Gherea",
    "Flaviu Cretu",
    "Remus Szilágyi",
    "Serafim Vulpes",
    "Grigore Oprea",
    "Gheorghe Dita",
    "Alexandru Diaconu",
    "Silviu Randa",
    "Bogdan Albescu",
    "Wadim Paler",
    "Beryx Chitu",
    "Petru Costin",
    "Drahoslav Marinescu",
    "Petru Artenie",
    "Dominik Goldis",
    "Lucian Niculescu",
    "Geza Catargiu",
    "Iancu Stirbei",
    "Laurentiu Lazarescu",
    "Ciodaru Vãduva",
    "Ciodaru Hanganu",
    "Rasvan Ardelean",
    "Stefan Saftoiu",
    "Niculaie Petri",
    "Abel Muresan",
    "Mihai Pîrvulescu",
    "Remus Tanase",
    "Adrian Caragiale",
    "Timotei Ripnu",
    "Teodor Filipescu",
    "Andrei Giurescu",
    "Emil Apostol",
    "Horasiu Marcovici",
    "Lucian Cojocaru",
    "Nicu Muresanu",
    "Valentin Lupu",
    "Beryx Dumitrescu"
)