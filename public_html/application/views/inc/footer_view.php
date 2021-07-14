<footer class="footer text-center">
    <br>
    <hr>
    <div style="font-size: 0.8em;">Associação Assistencial e Beneficente 2 de Julho</div>
    <div style="font-size: 0.8em;">Rua Manuel Bernardes, s/n<br>Itaipava, Itajaí, CEP 88316-400</div>
    <span style="font-size: 0.6em;">Copyright&copy; OakSystems <?= date('Y') ?></span>
</footer>
<script>
    $(document).ready(function () {
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        })
    });
</script>
</body>
</html>
<?php $this->session->unset_userdata('erro_mensagem'); ?>
<?php $this->session->unset_userdata('sucesso_mensagem'); ?>