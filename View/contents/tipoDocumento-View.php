
  <h1 style="text-align: center; padding: 30px">Gestión Tipo Documento</h1>
  <main class="container">
    <section class="row">
      <article class="col-md-5">
        <div class="card">
          <div class="card-body">
            <form method="post" id="id_tipoDocumento-form" class="ml-auto">
            <h3 class="text-center">Registro Tipo Documento</h3>
              <input type="hidden" id="id_tipoDocumento">
              <div class="form-group p-3">
                <label>Nombre Tipo Documento</label><br>
                 <input type="text" id="tipoDocumento" class="form-control" required=""><br>
              </div>
              <div class="form-group p-3">
                <label>Estado</label><br>
                <select name="estado" id="estado" class="custom-select form-control" required="" id="exampleFormControlSelect1">
                  <option value="true" selected disabled>Seleccione una id_tipoDocumento</option>
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select><br>
              </div>
              <div class="col-md-12 mb-3">
                <button type="submit" id="btnR" class="btn btn-primary mt-3 mb-3">Registrar</button>
                <input type="reset" value="Limpiar" class="btn btn-danger mt-3 mb-3 boton-limpiar" style="float: right;">
              </div>
            </form>
          </div>        
        </div>
      </article>
      <article class="col-md-7">
      <div class="box-body table-responsive">
        <table id="grid" class="table table-striped table-bordered nowrap" style="width:100%">
          <thead style="background-color: #dc3545;color: white; font-weight: bold;">
            <tr>
              <td width="10%">Nombre Tipo Documento</td>
              <td width="10%">Estado</td>
              <td width="1%">Acciones</td>
            </tr>
          </thead>
          <tbody id="tipoDocumentos">
          <tr>
              <td width="10%">Nombre Tipo Documento</td>
              <td width="10%">Estado</td>
              <td width="1%">Acciones</td>
            </tr>
          </tbody>
        </table>
        </div>
      </article>
    </section>
  </main>
<script src="http://localhost:8080/SIR/ajax/tipoDocumento.js"></script>