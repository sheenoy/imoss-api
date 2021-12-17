<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string("date_creation")->nullable();
            $table->string("date_maj")->nullable();
            $table->string("agence")->nullable();
            $table->string("agence_tel")->nullable();
            $table->string("agence_email")->nullable();
            $table->string("societe_raison_sociale")->nullable();
            $table->string("societe_forme_juri")->nullable();
            $table->string("societe_siret")->nullable();
            $table->string("societe_capital")->nullable();
            $table->string("societe_tva_intra")->nullable();
            $table->text("societe_adresse");
            $table->text("societe_code_postal");
            $table->text("societe_ville");
            $table->text("societe_carte_pro_num");
            $table->text("societe_carte_pro_date");
            $table->text("societe_carte_pro_pref");
            $table->text("societe_directeur_publication");
            $table->text("societe_caisse_garantie");
            $table->text("societe_rcs");
            $table->string("nego_nom")->nullable();
            $table->string("nego_tel")->nullable();
            $table->string("nego_email")->nullable();
            $table->string("nego_cp")->nullable();
            $table->text("nego_ville");
            $table->string("mandat")->nullable();
            $table->string("type_mandat")->nullable();
            $table->string("operation")->nullable();
            $table->string("viager")->nullable();
            $table->string("famille")->nullable();
            $table->string("type")->nullable();
            $table->string("idtype")->nullable();
            $table->string("nom_residence")->nullable();
            $table->string("adresse")->nullable();
            $table->string("code_postal")->nullable();
            $table->string("ville")->nullable();
            $table->string("localisation")->nullable();
            $table->string("numero_voie")->nullable();
            $table->string("pays")->nullable();
            $table->string("prix")->nullable();
            $table->string("date_dispo")->nullable();
            $table->string("date_echeance_preavis")->nullable();
            $table->string("taxe_fonciere")->nullable();
            $table->string("charges_mensuelles")->nullable();
            $table->string("prestige")->nullable();
            $table->string("neuf")->nullable();
            $table->string("surf_hab")->nullable();
            $table->string("surf_sejour")->nullable();
            $table->string("surf_terrain")->nullable();
            $table->string("piece")->nullable();
            $table->string("nb_etage")->nullable();
            $table->string("num_etage")->nullable();
            $table->string("nb_chambre")->nullable();
            $table->string("nb_sdb")->nullable();
            $table->string("nb_salle_deau")->nullable();
            $table->string("nb_wc")->nullable();
            $table->string("chauffage")->nullable();
            $table->string("nature_chauffage")->nullable();
            $table->string("balcon")->nullable();
            $table->string("meuble")->nullable();
            $table->string("ascenseur")->nullable();
            $table->string("nb_garage")->nullable();
            $table->string("terrasse")->nullable();
            $table->string("piscine")->nullable();
            $table->string("bail_duree")->nullable();
            $table->string("bail_date_fin")->nullable();
            $table->string("annee_constr")->nullable();
            $table->string("nom_occupant")->nullable();
            $table->string("loyer_mensuel_occupant")->nullable();
            $table->string("telephone_occupant")->nullable();
            $table->string("defisc")->nullable();
            $table->string("visite_virtuelle")->nullable();
            $table->text("titre_fr");
            $table->text("texte_fr");
            $table->text("titre_uk");
            $table->text("texte_uk");
            $table->text("titre_nl");
            $table->text("texte_nl");
            $table->string("dpe_non_soumis")->nullable();
            $table->string("dpe_consom_energ")->nullable();
            $table->string("dpe_lettre_consom_energ")->nullable();
            $table->string("dpe_emissions_ges")->nullable();
            $table->string("dpe_lettre_emissions_ges")->nullable();
            $table->string("dpe_etiquettes_vierges")->nullable();
            $table->string("dpe_date")->nullable();
            $table->string("dpe_depenses_annuelles_estimees_min")->nullable();
            $table->string("dpe_depenses_annuelles_estimees_max")->nullable();
            $table->string("dpe_depenses_annuelles_estimees_annee")->nullable();
            $table->string("honoraire_frais_dossier")->nullable();
            $table->string("honoraire_etat_lieux")->nullable();
            $table->string("pourcentage_honoraire_acquereur")->nullable();
            $table->string("copropriete")->nullable();
            $table->string("copropriete_nb_lots")->nullable();
            $table->string("copropriete_charges_annuelles")->nullable();
            $table->string("copropriete_procedure_syndicat")->nullable();
            $table->string("honoraire_a_charge_de")->nullable();
            $table->string("prix_hors_honoraire")->nullable();
            $table->string("url_bareme")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}