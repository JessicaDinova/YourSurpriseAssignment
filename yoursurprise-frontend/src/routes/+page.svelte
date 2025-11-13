<script>
	import {fetchCartData} from '$lib/api';

    let cartId = '';
    /**
     * @type {{ items: string | any[]; id: any; user_info: { name: any; }; grand_total: any; } | null}
     */
    let cart = null;
    let loading = false;
    let error = '';

    async function handleFetchCart() {
        if (!cartId) return;
        
        loading = true;
        error = '';
        cart = null;
        
        try {
            const id = Number(cartId);
            cart = await fetchCartData(id);
        } catch (err) {
             error = err instanceof Error ? err.message : 'An unknown error occurred';
        } finally {
            loading = false;
        }
    }
</script>

<svelte:head>
	<title>Cart</title>
</svelte:head>

<div class="h-screen w-screen flex flex-col items-center gap-7">
	<div class="w-full bg-gray-50 p-5">
		<h1 class="text-3xl text-center font-medium text-violet-400">Cart browsing</h1>
	</div>
	<div>
		<form class="flex flex-col gap-2">
			<label for="cardId">Select your cart</label>
			<div class="flex flex-row gap-2 items-center">
				<input class=" text-center focus:ring-1 focus:outline-none focus:ring-violet-400 border-2 rounded-xl border-gray-400 p-1 px-2" placeholder="Your cart number" type="number" bind:value={cartId} min="1" id="cartId">
				<button class=" w-32 py-0.5 cursor-pointer border-2 bg-violet-400 hover:scale-105 text-white border-violet-400 rounded-lg" on:click={handleFetchCart} disabled={loading || !cartId}>
					{loading ? 'Loading...' : 'View Cart'}
				</button>
			</div>
		</form>
	</div>
	 {#if cart}
	 {#if cart.items.length > 0}
		<div class="w-full h-full flex flex-col gap-12 font-medium px-16">
			<div class="w-full flex flex-row justify-between text-2xl">
				<h1>Shopping Cart #{cart.id}</h1>
				<h1 class=" text-violet-400 uppercase">{cart.user_info.name}</h1>
				<h1>{cart.items.length} {cart.items.length > 1 ? 'items' : 'item'}</h1>
			</div>
			<table class="table-fixed w-full text-center">
				<thead>
					<tr class=" font-medium text-xl">
						<th class="text-left">PRODUCT</th>
						<th>QUANTITY</th>
						<th>PRICE</th>
						<th>TOTAL</th>
					</tr>
				</thead>
				<tbody>
					{#each cart.items as item}
					<tr>
						<td class="flex flex-col">
							<div class="flex flex-row gap-2 justify-start text-left items-center">
								<img class=" h-20 w-20" src="{item.product.image}" alt="{item.product.title}">
								<div class="flex flex-col gap-2">
									{item.product.title}
									<p>⭐ {item.product.rating}</p>
								</div>
							</div>
						</td>
						<td>{item.quantity}</td>
						<td>
							{#if item.discount_percentage != null}
								<div class="flex flex-row gap-2 justify-center items-center">
									<p class="line-through text-gray-400">
										{item.unit_price}€
									</p>
									<p>
										{item.discounted_price}€
									</p>
								</div>
							{:else}
								{item.unit_price}€
							{/if}
						</td>
						<td>
							{item.total_items_price}€
						</td>
					</tr>
					{/each}
				</tbody>
			</table> 
			<h1 class="self-end text-xl">Total Price {cart.grand_total}€</h1>
		</div>
		{:else}
		<div class="flex flex-row gap-2 text-2xl">
			<h1 class="text-violet-400">{cart.user_info.name}</h1>
			<h1>your cart is empty!</h1>
		</div>
		{/if}
	{:else} 
		<h1>This cart doesn't exist! Try a different one</h1>
	{/if}
</div>
