<script>

	import axios from "axios";
	import Notification from "./components/Notification.svelte";
	import Map from "./components/Map.svelte";

	let name = "", number = "", type = "", address = "", cp = "", city = "", country = "", lon = "", lat = ""
	const types = ['rue', 'boulevard', 'impasse']
	let isRequired = false
	let notifySuccess = false
	let getFormData = async () => {
		let dataTest = {
			name,
			number,
			type,
			address,
			cp,
			city,
			country,
			lon,
			lat,
		}
		const insertDataUrl = '../wp-content/plugins/geoCode/model/InsertGeoData.php'
		if ((name && address && type && cp && city && lat && lon) !== "") {
			await axios.post(insertDataUrl, null, {params: dataTest})
					.then((response) => {
						if (response.statusText === "OK") {
							notifySuccess = true
							return response;
						} else {
							return response.statusText
						}
					})
					.catch((error) => {
						console.log(error)
					})
		} else {
			isRequired = true
		}
		if (notifySuccess) {
			name = ""
			number = ""
			type = ""
			address = ""
			cp = ""
			city = ""
			country = ""
			lon = ""
			lat = ""
			isRequired = false
		}
	}
</script>

<main>
	<form method="post">
		<div class="grid">
			{#if notifySuccess}
				<Notification/>
			{/if}
			<input class={isRequired ? 'required' : ''} type="text" name="name" id="name" bind:value={name} placeholder="Nom">
			<div class="grid c-20-15-a">
				<input type="text" name="number" id="number" bind:value={number}  placeholder="Number">
				<select class={isRequired ? 'required' : ''}  type="text" name="type" bind:value={type}  id="type">
					<option value="">T.voie</option>
					{#each types as typeItem}
						<option value="{typeItem}">{typeItem}</option>
					{/each}
				</select>
				<input class={isRequired ? 'required' : ''}  type="text" name="address" id="adresse" bind:value={address}  placeholder="Adresse">
			</div>
			<div class="grid c-2">
				<input class={isRequired ? 'required' : ''}  type="text" name="cp" id="cp" bind:value={cp}  placeholder="Code postal">
				<input class={isRequired ? 'required' : ''}  type="text" name="city" id="ville" bind:value={city}  placeholder="Ville">
			</div>
			<input class={isRequired ? 'required' : ''}  type="text" name="pays" id="pays" bind:value={country}  placeholder="Pays">
			<input class="button button-default" type="button" name="search" value="Rechercher Geocode Lon.Lat">
			<div class="grid c-2">
				<input class={isRequired ? 'required' : ''} type="text" name="lat" id="lat" bind:value={lat}  placeholder="Latitude">
				<input class={isRequired ? 'required' : ''} type="text" name="lon" id="lon" bind:value={lon}  placeholder="Longitude">
			</div>
			<button on:click={getFormData} class="button button-primary" type="button" value="Envoyer" name="submit">Envoyer</button>
		</div>
	</form>
	<Map/>
</main>


<style>
	main {
		text-align: center;
		padding: 1em;
		max-width: 240px;
		margin: 0 auto;
		display: grid;
		grid-template-columns: auto 1fr;
		position: relative;
		overflow: hidden;
	}

	h1 {
		color: #ff3e00;
		text-transform: uppercase;
		font-size: 4em;
		font-weight: 100;
	}

	.grid {
		display: grid;
		gap: 16px;
		overflow: hidden;
	}

	.grid.c-2 {
		grid-template-columns: auto auto;
		position: relative;
	}

	.grid.c-20-15-a {
		grid-template-columns: 20% 15% auto;
	}

	select.required,input.required {
		border-color: red;
	}

	@media (min-width: 640px) {
		main {
			max-width: none;
		}
	}
</style>