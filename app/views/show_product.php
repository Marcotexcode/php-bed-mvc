<!-- Mostra il template del singolo prodotto. -->

<article>
    <h1>Product</h1>
    <!-- Messaggio passato dall metodo show della classe ProductController -->
    <!-- htmlentities evita di fari ignettare dei caratteri tipo javascript e solo htlm.  -->
    <span> <?= htmlentities($message) ?></span>
</article>