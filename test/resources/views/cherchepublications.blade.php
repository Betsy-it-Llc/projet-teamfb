@extends('layouts.navadmin')
@section('content')
    <div class="row" style="margin-top: 1rem;">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Cherche publications (2)</h2>
                <br>
            </div>
            <H5>Partage</H()>
            <div class="advance-search">
                <div class="form-row" style="font-size : 10px">            
                        <div class="col">
                            <div class="input-select">
                            <select data-trigger="" name="choices-single-defaul" class="form-control">
                                          <option selected>Prenom ambassadeur</option>
                                          <option>Laura</option>
                                          <option>Aurore</option>
                                          <option>Chloé</option>
                                          <option>Lalachante</option>
                                          <option>Hugo</option>
                                          <option>Justine</option>
                                          <option>Emilie</option>
                            </select>                            
                            </div>
                        </div>

                        <div class="col">
                            <div class="input-select">
                            <select data-trigger="" name="choices-single-defaul" class="form-control">
                                          <option selected>Nom ambassadeur</option>
                                          <option>Lalachante</option>
                                          <option>Loiseau</option>
                                          <option>Toulouse</option>
                                          <option>Martin</option>
                            </select>                            
                            </div>
                        </div>
                </div>
            </div>     

            <H5>Recherche</H()>
            <div class="advance-search">
                <div class="form-row" style="font-size : 10px">            
                        <div class="col">
                            <div class="input-select">
                            <select data-trigger="" name="choices-single-defaul" class="form-control">
                                          <option selected>Prenom ambassadeur recherche</option>
                                          <option>Laura</option>
                                          <option>Aurore</option>
                                          <option>Chloé</option>
                                          <option>Lalachante</option>
                                          <option>Hugo</option>
                                          <option>Justine</option>
                                          <option>Emilie</option>
                            </select>                            
                            </div>
                        </div>

                        <div class="col">
                            <div class="input-select">
                            <select data-trigger="" name="choices-single-defaul" class="form-control">
                                          <option selected>Nom ambassadeur recherche</option>
                                          <option>Lalachante</option>
                                          <option>Loiseau</option>
                                          <option>Toulouse</option>
                                          <option>Martin</option>
                            </select>                            
                            </div>
                        </div>
                </div>
            </div>      
            
            <H5>Contenu</H()>
            <div class="advance-search" style="margin-bottom : 20px">
                <div class="form-row" style="font-size : 10px">            
                        <div class="col">
                            <div class="input-select">
                            <input class="form-control" type="text" name="tag" id="tag" placeholder="Lien/contenu post mère ">                          
                            </div>
                        </div>

                        <div class="col">
                            <div class="input-select">
                            <input class="form-control" type="text" name="tag" id="tag" placeholder="Lien/contenu post partagé">                        
                            </div>
                        </div>
                </div>
            </div>  
            <button class="btn" style="margin-bottom : 20px">Envoyer</button>



        </div>
    </div>
   <br><br>

    <div class="table">
        <table class="table">
            <thead class="thead" style="background:#bfbfbf">
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Statut</th>
                <th scope="col">Durée</th>
                <th scope="col">Nom ambassadeur</th>
                <th scope="col">Prenom Ambassadeur</th>
                <th scope="col">Campagne</th>
                <th scope="col">Segmentation</th>
                <th scope="col">Voir rapport</th>
                <th width="150px"></th>
            </tr>
            </thead>
            <tr>
                <td>Date</td>
                <td>Statut</td>
                <td>Jours</td>
                <td>LalaChante</td>
                <td>Laura</td> 
                <td>0</td>
                <td>1</td>
                <td>Market Support/Bug</td>
            </tr>
            <tr>
                <td>Date</td>
                <td>Statut</td>
                <td>Jours</td>
                <td>LalaChante</td>
                <td>Laura</td>
                <td>0</td>
                <td>1</td>
                <td>Market Support/Bug</td>
            </tr>
            <tr>
                <td>Date</td>
                <td>Statut</td>
                <td>Jours</td>
                <td>LalaChante</td>
                <td>Laura</td>
                <td>0</td>
                <td>1</td>
                <td>Market Support/Bug</td>
            </tr>
            <tr>
                <td>Date</td>
                <td>Statut</td>
                <td>Jours</td>
                <td>LalaChante</td>
                <td>Laura</td>
                <td>0</td>
                <td>1</td>
                <td>Market Support/Bug</td>
            </tr>
            <tr>
                <td>Date</td>
                <td>Statut</td>
                <td>Jours</td>
                <td>LalaChante</td>
                <td>Laura</td>
                <td>0</td>
                <td>1</td>
                <td>Market Support/Bug</td>
            </tr>
            <tr>
                <td>Date</td>
                <td>Statut</td>
                <td>Jours</td>
                <td>LalaChante</td>
                <td>Laura</td>
                <td>0</td>
                <td>1</td>
                <td>Market Support/Bug</td>
            </tr>
            <tr>
                <td>Date</td>
                <td>Statut</td>
                <td>Jours</td>
                <td>LalaChante</td>
                <td>Laura</td>
                <td>0</td>
                <td>1</td>
                <td>Market Support/Bug</td>
            </tr>
        </table>  
    </div>
    @endsection