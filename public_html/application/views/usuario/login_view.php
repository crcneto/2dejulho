<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="panel-title text-center">Entrar no sistema</div>
        </div>
        <div class="panel-body">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form action="<?=  site_url('autenticacao/login')?>" method="post">
                    <label>E-mail</label>
                    <input type="text" name="email" class="form-control" />
                    <label>Senha</label>
                    <input type="password" name="senha" class="form-control" />
                    <br>
                    <div class="text-center">
                        <?=  btn("Enviar", "success", "lg", "Entrar no sistema", "top")?>
                    </div>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</div>