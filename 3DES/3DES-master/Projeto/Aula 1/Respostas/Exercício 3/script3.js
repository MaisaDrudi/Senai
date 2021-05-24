var a = 30
var b = 30
var c = 10

console.log(`Os valores a = ${a}, b = ${b}, c = ${c} são um:`)

if ((a == b)&&(b == c)&&(a == c)){
    console.log('Equilátero')

} else if ((a != b)&&(b != c)&&(a == c)){
    console.log('Isóceles')
} else if ((a == b)&&(b != c)&&(a != c)){
    console.log('Isóceles')
} else if ((a != b)&&(b == c)&&(a != c)){
    console.log('Isóceles') 

} else if ((a != b)&&(b != c)&&(a != b)){
    console.log('Escaleno')
}