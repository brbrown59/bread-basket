var frisby = require('frisby');

frisby.create('get new cart')
	.post(url + '/carts')
	//some some expectations
	.afterJSON(function(json) {
		var cartId = json.cartId;

		frisby.create('add item to cart')
			.post(url + '/carts/' + cartId, {
				"itemId": itemId,
				"quantity": qty
			}, {
				json: true
			})
			//some some expectations
			.after(function() {

				frisby.create('edit cart')
					.put(url + '/carts/' + cartId, {
						"itemId": itemId,
						"quantity": qty
					}, {
						json: true
					})
					//some expectations
					.after(function() {

						frisby.create('clear cart')
							.delete(url + '/carts/' + cartId + "/items/" + itemId)
							//some expectations
							.toss();
					}).toss();
			}).toss();
	}).toss();