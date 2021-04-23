function add(a, b) {
    return ((((a & b) << 1) ^ (a ^ b)) | ((((a & b) << 1) & (a ^ b)) << 1))
}