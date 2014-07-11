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
</div><!-- /.modal ifrWebsiteModal-->

<div class="modal fade" id="invalidCredentialsModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Echec de l'authentification</h4>
            </div>
            <div class="modal-body">
                <p>Login et/ou mot de passe invalide(s). Veuillez vérifier vos identifiants.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal invalidCredentialsModal-->

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
</div><!-- /.modal sciformaModal-->


<!--                CURRENTLY NOT USED              -->

<div id="affaireModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">Détails de l'affaire</h4>
            </div><!-- /.modal-header -->

            <div class="modal-body overflow-visible">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="widget-box">
                            <div class="widget-header">
                                <h4>Affaire</h4>

                                <div class="widget-toolbar">
                                    <a href="#" data-action="collapse">
                                        <i class="icon-chevron-up"></i>
                                    </a>

                                    <a href="#" data-action="close">
                                        <i class="icon-remove"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div>
                                        <label for="code">Code</label>
                                        <textarea id="code" class="autosize-transition form-control"></textarea>
                                    </div>
                                    <hr />
                                    <div>
                                        <label for="societe">Société</label>
                                        <textarea id="societe" class="autosize-transition form-control"></textarea>
                                    </div>
                                    <hr />
                                    <div>
                                        <label for="contact">Contact</label>
                                        <textarea id="contact" class="autosize-transition form-control"></textarea>
                                    </div>
                                    <hr />
                                    <div>
                                        <label for="intitule">Intitulé de l'affaire</label>
                                        <textarea id="intitule" class="autosize-transition form-control"></textarea>
                                    </div>
                                    <hr />
                                    <div>
                                        <label for="progiciel">Progiciel</label>
                                        <textarea id="progiciel" class="autosize-transition form-control"></textarea>
                                    </div>
                                    <hr />
                                    <div>
                                        <label for="projet">Projet</label>
                                        <textarea id="projet" class="autosize-transition form-control"></textarea>
                                    </div>
                                    <hr />
                                    <div>
                                        <label for="chargeDaffaire">Commercial en charge de l'affaire</label>
                                        <textarea id="chargeDaffaire" class="autosize-transition form-control"></textarea>
                                    </div>
                                    <hr />
                                    <div>
                                        <label for="devise">Devise</label>
                                        <textarea id="devise" class="autosize-transition form-control"></textarea>
                                    </div>
                                    <hr />
                                </div>
                            </div>
                        </div>
                    </div><!-- /col-sm-4 -->

                    <div class="col-sm-4">
                        <div class="widget-box">
                            <div class="widget-header">
                                <h4>Eléments financiers</h4>

                                <div class="widget-toolbar">
                                    <a href="#" data-action="collapse">
                                        <i class="icon-chevron-up"></i>
                                    </a>

                                    <a href="#" data-action="close">
                                        <i class="icon-remove"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div>
                                        <label for="totalHT">Total HT</label>
                                        <textarea id="totalHT" class="autosize-transition form-control"></textarea>
                                    </div>
                                    <hr />
                                    <div>
                                        <label for="CARealiseHT">CA réalisé HT</label>
                                        <textarea id="CARealiseHT" class="autosize-transition form-control"></textarea>
                                    </div>
                                    <hr />
                                    <div>
                                        <label for="CAFactureHT">CA facturé HT</label>
                                        <textarea id="CAFactureHT" class="autosize-transition form-control"></textarea>
                                    </div>
                                    <hr />
                                    <div>
                                        <label for="PCA">PCA</label>
                                        <textarea id="PCA" class="autosize-transition form-control"></textarea>
                                    </div>
                                    <hr />
                                    <div>
                                        <label for="FAE">FAE</label>
                                        <textarea id="FAE" class="autosize-transition form-control"></textarea>
                                    </div>
                                    <hr />
                                    <div>
                                        <label for="AAE">AAE</label>
                                        <textarea id="AAE" class="autosize-transition form-control"></textarea>
                                    </div>
                                    <hr />
                                    <div>
                                        <label for="CARestantHT">CA restant HT</label>
                                        <textarea id="CARestantHT" class="autosize-transition form-control"></textarea>
                                    </div>
                                    <hr />
                                    <div>
                                        <label for="ResteAFacturerHT">Reste à facturer HT</label>
                                        <textarea id="ResteAFacturerHT" class="autosize-transition form-control"></textarea>
                                    </div>
                                    <hr />
                                    <div>
                                        <label for="RestantDuTTC">Restant dû TTC</label>
                                        <textarea id="RestantDuTTC" class="autosize-transition form-control"></textarea>
                                    </div>
                                    <hr />
                                </div>
                            </div>
                        </div>
                    </div><!-- /col-sm-4 -->

                    <div class="col-sm-4">
                        <div class="widget-box">
                            <div class="widget-header">
                                <h4>Suivi</h4>

                                <div class="widget-toolbar">
                                    <a href="#" data-action="collapse">
                                        <i class="icon-chevron-up"></i>
                                    </a>

                                    <a href="#" data-action="close">
                                        <i class="icon-remove"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div>
                                        <label for="crPar">Créé par</label>
                                        <textarea id="crPar" class="autosize-transition form-control"></textarea>
                                    </div>
                                    <hr />
                                    <div>
                                        <label for="crLe">Créé le</label>
                                        <textarea id="crLe" class="autosize-transition form-control"></textarea>
                                    </div>
                                    <hr />
                                    <div>
                                        <label for="modifiePar">Modifié par</label>
                                        <textarea id="modifiePar" class="autosize-transition form-control"></textarea>
                                    </div>
                                    <hr />
                                    <div>
                                        <label for="modifieLe">Modifié le</label>
                                        <textarea id="modifieLe" class="autosize-transition form-control"></textarea>
                                    </div>
                                    <hr />
                                </div>
                            </div>
                        </div>
                    </div><!-- /span -->



                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-sm" data-dismiss="modal">
                    <i class="icon-remove"></i>
                    Fermer
                </button>
            </div>
        </div>
    </div>
</div> <!-- /affaireModal -->

<!--                /.CURRENTLY NOT USED              -->




<script type="text/javascript">

    function openIFRWebsite(){
        window.open("http://www.ifrskeyes.com",'_blank');
    };

    function openSciforma(){
        window.open("http://srvsciforma01:8080/sciformaprod/main.html#Login",'_blank');
    };



</script>