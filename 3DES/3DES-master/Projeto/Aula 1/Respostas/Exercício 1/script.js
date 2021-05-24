var nome = 'Maristela'
var idade = 103

console.log(`${nome}, você tem ${idade} anos. Você é:`)
if(idade < 12) {
    console.log('Criança')
} else if (idade < 18){
    console.log('Adolescente.')
} else if (idade < 30){
    console.log ('Jovem.')
} else if (idade < 49){
    console.log ('Adulto.')
} else if (idade < 55){
    console.log ('Meia idade.')
} else if (idade < 80){
    console.log ('Idoso.')
} else if (idade < 95){
    console.log ('Ancião.')
} else if (idade < 150){
    console.log ('Provavelmente um defunto.')
}