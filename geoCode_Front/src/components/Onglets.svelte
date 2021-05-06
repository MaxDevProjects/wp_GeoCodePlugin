<script>
    import Form from "./Form.svelte";
    import List from "./List.svelte";

    let current = 2

</script>

<style>
    ul {
        list-style: none;
        display: flex;
    }

    li {
        padding: 6px;
        color: #0b7cac;
        cursor: pointer;
    }

    .selected {
        text-decoration: underline;
    }
</style>

<div>
    <ul>
        <li  on:click={() => current = 1} class="{current === 1 ? 'selected' : ''}">Formulaire</li>
        <li on:click={() => current = 2} class="{current === 2 ? 'selected' : ''}">Gestion des données</li>
        <!--<li  on:click={() => current = 3} class="{current === 3 ? 'selected' : ''}">Clés API</li>-->
    </ul>
    {#if current === 1}
    <Form/>
    {/if}
    {#if current === 2}
    <List/>
    {/if}
</div>