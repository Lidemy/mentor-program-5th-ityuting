function add(a,b){
    a_length = String(a.toString("2")).length;
    b_length = String(b.toString("2")).length;
    let max = 0;
    if (a_length >= b_length){
        max = a_length;
    } else {
        max = b_length;
    }
    let carry = (a & b) << 1;
    let plus = a ^ b;
    let newcarry = 0;
    let newplus = 0;
    for (let loops = 2; loops <= max; loops++){
        newcarry = (carry & plus) << 1;
        newplus = (carry ^ plus);
        carry = newcarry;
        plus = newplus;
    }
    return carry|plus;
}
