<script>
    export let datas = null
    let getPositionXY = (data) => {
        let x = data.latitude
        let y = data.longitude
    }
</script>

<style>
div {
    position: absolute;
    top: 0;
    right: 0;
    z-index: 9999999;
    background: white;
    height: 100%;
}

ul > li{
    text-align: right;
    padding: 4px 6px;
}

ul > li:hover {
    background-color: #f1f1f1;
    cursor: pointer;
}
</style>

<div>
    {#if datas}
    <ul>
        {#each datas as data}
            <li on:click={getPositionXY(data)}>{data.nom}</li>
        {/each}
    </ul>
    {/if}
</div>