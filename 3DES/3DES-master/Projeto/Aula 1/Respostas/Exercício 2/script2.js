var nome = 'Carlitota'
var peso = 91
var altura = 1.67
var imc = peso/(altura*altura)

console.log(`Olá ${nome}, seu peso é ${peso}, sua altura ${altura} e por seu imc você é: `)
if(imc <= 16){
    console.log('Magro(a).')
} else if(imc < 21){
    console.log('Fitness.')
} else if(imc < 29.5){
    console.log('Sarado(a).')
} else if(imc < 40){
    console.log('Fofinho(a).')
} else {
    console.log('Gordo(a).')
}