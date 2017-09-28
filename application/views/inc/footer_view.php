<footer class="footer text-center">
    <br>
    <hr>
    <div style="font-size: 0.8em;">Office Bella Città - Avenida Brasil Oeste, 560, salas 2601/2602<br>Centro, Passo Fundo, CEP 99025-000</div>
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