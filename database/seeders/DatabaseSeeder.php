<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key constraints on the other connection
        \Schema::disableForeignKeyConstraints();
        \Schema::connection('mysql2')->disableForeignKeyConstraints();
        $this->call([
            CountriesSeeder::class,
        ]);
        $this->command->info('Seeded the countries!');
        // \App\Models\User::factory(10)->create();
        $this->call(AdministrationTableSeeder::class);
        $this->call(AmbassadeurGroupeTableSeeder::class);
        $this->call(AmbassadeursTableSeeder::class);
        $this->call(AnalysePostsGroupeTableSeeder::class);
        $this->call(CampagneGroupeTableSeeder::class);
        $this->call(CampagneSegmentTableSeeder::class);
        // $this->call(CampagnesTableSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(FailedJobsTableSeeder::class);
        $this->call(GroupeFacebookTableSeeder::class);
        $this->call(GroupesTableSeeder::class);
        $this->call(InteractionTableSeeder::class);
        $this->call(ListeTableSeeder::class);
        $this->call(ListeGroupeTableSeeder::class);
        $this->call(ModelHasPermissionsTableSeeder::class);
        $this->call(ModelHasRolesTableSeeder::class);
        $this->call(ModerateurAdministrateurTableSeeder::class);
        $this->call(NewTableTableSeeder::class);
        $this->call(PasswordResetsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PersonalAccessTokensTableSeeder::class);
        $this->call(PostgroupesTableSeeder::class);
        $this->call(PostmeresTableSeeder::class);
        $this->call(PostpartagesTableSeeder::class);
        $this->call(QuestionAdhesionGroupeTableSeeder::class);
        $this->call(QuestionadsTableSeeder::class);
        $this->call(RechercheCampagneTableSeeder::class);
        $this->call(ReleveCampagneTableSeeder::class);
        $this->call(RelevePageLalachanteTableSeeder::class);
        $this->call(RelevePostTableSeeder::class);
        $this->call(RoleHasPermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(SegementationsTableSeeder::class);
        $this->call(SegementsTableSeeder::class);
        $this->call(SegmentGroupeTableSeeder::class);
        $this->call(SuppGroupeSegmentTemporaireTableSeeder::class);
        $this->call(SuppGroupeSegmentTemporaire2TableSeeder::class);
        $this->call(SuppGroupeTestTableSeeder::class);
        $this->call(SuppGroupeavecambassadeursTableSeeder::class);
        $this->call(SuppGroupeavecsegmentationsTableSeeder::class);
        $this->call(SuppGroupecampagnesTableSeeder::class);
        $this->call(SuppGroupesansambassadeursTableSeeder::class);
        $this->call(SuppGroupesanssegmentationsTableSeeder::class);
        $this->call(SuppGroupesanssegmentsTableSeeder::class);
        $this->call(SuppModeradmingroupTableSeeder::class);
        $this->call(SuppSegViewTableSeeder::class);
        $this->call(SuppTableTestTableSeeder::class);
        $this->call(SuppUtilisateursTableSeeder::class);
        $this->call(SuppUtilisateurssTableSeeder::class);
        $this->call(SuppUtilisateurssssTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UtilisateurTableSeeder::class);
        $this->call(UtilisateurGroupeTableSeeder::class);
        
        $this->call(AutrePrestationExperienceTableSeeder::class);
        $this->call(ContactCodePromoTableSeeder::class);
        $this->call(InteractionTagTableSeeder::class);
        $this->call(LivrablesTableSeeder::class);
        $this->call(PackExperienceTableSeeder::class);
        $this->call(FacturesTableSeeder::class);
        $this->call(PacksRemiseTableSeeder::class);
        $this->call(ContactEntrepriseTableSeeder::class);
        $this->call(ExperienceStatutNotificationTableSeeder::class);
        $this->call(ParrainageTableSeeder::class);
        $this->call(JeuxConcoursTableSeeder::class);
        $this->call(HistoriqueRemiseTableSeeder::class);
        $this->call(FactureProduitServiceTableSeeder::class);
        $this->call(ProjetsTableSeeder::class);
        $this->call(BonCadeauTableSeeder::class);
        $this->call(InteractionTableSeeder::class);
        $this->call(VideoTableSeeder::class);
        $this->call(TagStorytellingTableSeeder::class);
        $this->call(PackProduitServiceTableSeeder::class);
        $this->call(CagnottesTableSeeder::class);
        $this->call(FacturesRemiseTableSeeder::class);
        $this->call(HistoriquesTableSeeder::class);
        $this->call(NotificationTableSeeder::class);
        $this->call(FactureStatutNotificationTableSeeder::class);
        $this->call(CodesPromoTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ContactPersonaTableSeeder::class);
        $this->call(ContactNotificationTableSeeder::class);
        $this->call(ListePrixTableSeeder::class);
        $this->call(TagStoryTableSeeder::class);
        $this->call(PackTableSeeder::class);
        $this->call(ContributionsTableSeeder::class);
        $this->call(ContentsExperienceTableSeeder::class);
        $this->call(OrganisationCagnotteTableSeeder::class);
        $this->call(ContactTableSeeder::class);
        $this->call(PrestationIntervenantTableSeeder::class);
        $this->call(PhotoTableSeeder::class);
        $this->call(PersonaTableSeeder::class);
        $this->call(ProduitServiceRemiseTableSeeder::class);
        $this->call(RemiseEntrepriseTableSeeder::class);
        $this->call(ContactExperienceTableSeeder::class);
        $this->call(StorytellingTableSeeder::class);
        $this->call(EvenementTableSeeder::class);
        $this->call(TagInteractionTableSeeder::class);
        $this->call(ExperienceStatutTableSeeder::class);
        $this->call(IntervenantTableSeeder::class);
        $this->call(ExperienceTableSeeder::class);
        $this->call(MediaTableSeeder::class);
        $this->call(PaiementTableSeeder::class);
        $this->call(FactureStatutTableSeeder::class);
        $this->call(PrestationIntervantExperienceTableSeeder::class);
        $this->call(RemiseTableSeeder::class);
        $this->call(InvitationsTableSeeder::class);
        $this->call(SonTableSeeder::class);
        $this->call(ContactJeuxTableSeeder::class);
        $this->call(CommentairesTableSeeder::class);
        $this->call(EmailTableSeeder::class);
        $this->call(ProduitsServicesTableSeeder::class);
        $this->call(OrganisationTableSeeder::class);
        $this->call(PartenaireTableSeeder::class);
        $this->call(RetraitsTableSeeder::class);
        $this->call(StatutsCagnottesTableSeeder::class);
        $this->call(StatutsProjetsTableSeeder::class);
        $this->call(TypesProjetsTableSeeder::class);
        $this->call(ContactProjetsTableSeeder::class);
        // Re-enable foreign key constraints
        \Schema::enableForeignKeyConstraints();
        \Schema::connection('mysql2')->enableForeignKeyConstraints(); 
    }
}
