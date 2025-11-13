
/**
 * @param {number} cartId
 */
export async function fetchCartData(cartId) {
    const response = await fetch(`http://localhost:8000/api/carts/${cartId}`)
    if (!response.ok) throw new Error('Cart was not found');
    return await response.json();
}

/**
 * @param {number} productId
 */
export async function fetfetchProductData(productId) {
    const response = await fetch(`http://localhost:8000/api/products/${productId}`)
    if (!response.ok) throw new Error('Product was not found');
    return await response.json();
}