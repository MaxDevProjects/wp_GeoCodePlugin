<script>

	import Map from "./components/Map.svelte";
	import Onglets from "./components/Onglets.svelte";


</script>

<main>
<div class="main">
	<Onglets/>
	<Map/>
</div>
</main>


<style>
	main {
		text-align: center;
		padding: 1em;
		margin: 0 auto;
	}

	.main {
		display: grid;
		grid-template-rows: 1fr 1fr;
	}

	h1 {
		color: #ff3e00;
		text-transform: uppercase;
		font-size: 4em;
		font-weight: 100;
	}

</style>