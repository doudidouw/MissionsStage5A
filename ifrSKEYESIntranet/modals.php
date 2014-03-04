<div class="modal fade" id="ifrWebsiteModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Ouverture de la page</h4>
      </div>
      <div class="modal-body">
        <p>La page www.ifrskeyes.com sera affichée dans un nouvel onglet.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="openIFRWebsite()">OK</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="sciformaModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Lancement de Sciforma</h4>
      </div>
      <div class="modal-body">
        <p>Par mesure de sécurité, Sciforma sera lancé dans un nouvel onglet.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="openSciforma()">OK</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<script type="text/javascript">
    
    function openIFRWebsite(){
        window.open("http://www.ifrskeyes.com",'_blank');
    };
    
    function openSciforma(){
        window.open("http://srvsciforma01:8080/sciformaprod/main.html#Login",'_blank');
    };
    
    
    
</script>