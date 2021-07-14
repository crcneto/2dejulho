<div class="container" style="padding-top: 30px;">
    <div class="col-md-3"></div>
    <div class="panel panel-default col-md-6">
        <h1 class="text-center">Contato</h1>
        <br>
        <p>Dúvidas, sugestões ou reclamações, entre em contato com a gente. Envie um e-mail para <a href="mailto:secretaria@2dejulho.org">secretaria@2dejulho.org</a> ou preencha o formulário abaixo.</p>
        <p>Agradecemos o seu contato.</p>
        <br>
        <form action="<?= site_url('home/send') ?>" method="post" style="padding-bottom: 30px;">
            <label>Seu nome</label>
            <input type="text" name="nome" class="form-control" value="<?php if (isset($req['nome'])) {
    echo $req['nome'];
} ?>" />
            <label>E-mail</label>
            <input type="text" name="email" class="form-control"  value="<?php if (isset($req['email'])) {
    echo $req['email'];
} ?>"/>
            <label>Telefone para contato</label>
            <input type="text" name="telefone" class="form-control"  value="<?php if (isset($req['telefone'])) {
    echo $req['telefone'];
} ?>" />
            <!--br>
            <label>Motivo do contato</label>
            <select name="motivo" class="form-control selectpicker" data-live-search="true">
                <option value="1">Dúvida</option>
                <option value="2">Sugestão</option>
                <option value="3">Reclamação</option>
            </select-->
            <label>Título</label>
            <input type="text" name="titulo" class="form-control"  value="<?php if (isset($req['titulo'])) {
    echo $req['titulo'];
} ?>"/>
            <label>Mensagem</label>
            <textarea name="mensagem" style="resize: none;" rows="6" class="form-control"><?php if (isset($req['mensagem'])) {
    echo $req['mensagem'];
} ?></textarea>
            <br>
            <div class="text-right"><?= btn("Enviar", "success") ?></div>
        </form>

    </div>
    <div class="col-md-3"></div>
</div>
