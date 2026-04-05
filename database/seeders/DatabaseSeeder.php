<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Formation;
use App\Models\Chapitre;
use App\Models\SousChapitre;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Reponse;
use App\Models\Note;
use App\Models\QuizResult;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ===== UTILISATEURS =====
        $admin = User::create([
            'name' => 'Admin LMS', 'nom' => 'Admin', 'prenom' => 'Super',
            'email' => 'admin@lms.fr', 'password' => Hash::make('password'), 'role' => 'admin',
        ]);

        $apprenant1 = User::create([
            'name' => 'Jean Dupont', 'nom' => 'Dupont', 'prenom' => 'Jean',
            'email' => 'apprenant1@lms.fr', 'password' => Hash::make('password'), 'role' => 'apprenant',
        ]);

        $apprenant2 = User::create([
            'name' => 'Marie Martin', 'nom' => 'Martin', 'prenom' => 'Marie',
            'email' => 'apprenant2@lms.fr', 'password' => Hash::make('password'), 'role' => 'apprenant',
        ]);

        $apprenant3 = User::create([
            'name' => 'Pierre Durand', 'nom' => 'Durand', 'prenom' => 'Pierre',
            'email' => 'apprenant3@lms.fr', 'password' => Hash::make('password'), 'role' => 'apprenant',
        ]);

        // ===== FORMATION : VERBES IRRÉGULIERS =====
        $formation = Formation::create([
            'nom' => 'Anglais — Les verbes irréguliers',
            'description' => 'Cours complet sur les verbes irréguliers en anglais. Apprenez les formes irrégulières les plus courantes avec des exercices et des quiz.',
            'niveau' => 'débutant',
            'duree' => '2 semaines',
        ]);

        // Inscription des apprenants
        $formation->apprenants()->attach([
            $apprenant1->id => ['enrolled_at' => now()],
            $apprenant2->id => ['enrolled_at' => now()],
            $apprenant3->id => ['enrolled_at' => now()],
        ]);

        // --- CHAPITRE 1 ---
        $ch1 = Chapitre::create([
            'titre' => 'Introduction aux verbes irréguliers',
            'description' => 'Comprendre ce que sont les verbes irréguliers et pourquoi ils sont importants.',
            'ordre' => 1, 'formation_id' => $formation->id,
        ]);

        SousChapitre::create([
            'titre' => 'Qu\'est-ce qu\'un verbe irrégulier ?',
            'contenu' => '<h2>Définition</h2><p>En anglais, un <strong>verbe irrégulier</strong> est un verbe dont la conjugaison au <em>prétérit</em> (past simple) et au <em>participe passé</em> (past participle) ne suit pas la règle habituelle d\'ajouter <code>-ed</code>.</p><h3>Verbe régulier vs irrégulier</h3><table border="1" cellpadding="8"><tr><th>Type</th><th>Base</th><th>Prétérit</th><th>Participe passé</th></tr><tr><td>Régulier</td><td>walk</td><td>walk<strong>ed</strong></td><td>walk<strong>ed</strong></td></tr><tr><td>Irrégulier</td><td>go</td><td><strong>went</strong></td><td><strong>gone</strong></td></tr></table><p>Il existe environ <strong>200 verbes irréguliers</strong> en anglais, mais seuls 50 à 70 sont vraiment courants.</p>',
            'ordre' => 1, 'chapitre_id' => $ch1->id,
        ]);

        SousChapitre::create([
            'titre' => 'Différence entre verbes réguliers et irréguliers',
            'contenu' => '<h2>Comment les distinguer ?</h2><p>Il n\'existe malheureusement <strong>pas de règle simple</strong> pour savoir si un verbe est irrégulier. Il faut les apprendre par cœur.</p><h3>Quelques astuces</h3><ul><li>Les verbes les plus <strong>courants</strong> sont souvent irréguliers (be, have, do, go, make...)</li><li>Certains suivent des <strong>patterns</strong> similaires : think/thought, buy/bought, bring/brought</li><li>Les verbes d\'origine <strong>germanique</strong> sont plus souvent irréguliers</li></ul>',
            'ordre' => 2, 'chapitre_id' => $ch1->id,
        ]);

        // --- CHAPITRE 2 ---
        $ch2 = Chapitre::create([
            'titre' => 'Les 20 verbes irréguliers les plus fréquents',
            'description' => 'Maîtrisez les verbes irréguliers indispensables.',
            'ordre' => 2, 'formation_id' => $formation->id,
        ]);

        $sc21 = SousChapitre::create([
            'titre' => 'Les 10 verbes indispensables',
            'contenu' => '<h2>Les 10 verbes irréguliers les plus utilisés</h2><table border="1" cellpadding="8"><tr><th>Base</th><th>Prétérit</th><th>Participe passé</th><th>Traduction</th></tr><tr><td>be</td><td>was/were</td><td>been</td><td>être</td></tr><tr><td>have</td><td>had</td><td>had</td><td>avoir</td></tr><tr><td>do</td><td>did</td><td>done</td><td>faire</td></tr><tr><td>go</td><td>went</td><td>gone</td><td>aller</td></tr><tr><td>say</td><td>said</td><td>said</td><td>dire</td></tr><tr><td>make</td><td>made</td><td>made</td><td>fabriquer</td></tr><tr><td>take</td><td>took</td><td>taken</td><td>prendre</td></tr><tr><td>come</td><td>came</td><td>come</td><td>venir</td></tr><tr><td>see</td><td>saw</td><td>seen</td><td>voir</td></tr><tr><td>get</td><td>got</td><td>got/gotten</td><td>obtenir</td></tr></table>',
            'ordre' => 1, 'chapitre_id' => $ch2->id,
        ]);

        SousChapitre::create([
            'titre' => '10 autres verbes essentiels',
            'contenu' => '<h2>Continuons avec 10 autres verbes</h2><table border="1" cellpadding="8"><tr><th>Base</th><th>Prétérit</th><th>Participe passé</th><th>Traduction</th></tr><tr><td>give</td><td>gave</td><td>given</td><td>donner</td></tr><tr><td>find</td><td>found</td><td>found</td><td>trouver</td></tr><tr><td>think</td><td>thought</td><td>thought</td><td>penser</td></tr><tr><td>tell</td><td>told</td><td>told</td><td>raconter</td></tr><tr><td>become</td><td>became</td><td>become</td><td>devenir</td></tr><tr><td>leave</td><td>left</td><td>left</td><td>partir</td></tr><tr><td>feel</td><td>felt</td><td>felt</td><td>ressentir</td></tr><tr><td>put</td><td>put</td><td>put</td><td>mettre</td></tr><tr><td>bring</td><td>brought</td><td>brought</td><td>apporter</td></tr><tr><td>begin</td><td>began</td><td>begun</td><td>commencer</td></tr></table>',
            'ordre' => 2, 'chapitre_id' => $ch2->id,
        ]);

        // --- QUIZ pour sous-chapitre 2.1 ---
        $quiz1 = Quiz::create([
            'titre' => 'Quiz : Les 10 verbes indispensables',
            'description' => 'Testez vos connaissances sur les 10 verbes irréguliers les plus courants.',
            'sous_chapitre_id' => $sc21->id,
        ]);

        $questions = [
            ['texte' => 'Quel est le prétérit de "go" ?', 'reponses' => ['goed', 'went', 'gone', 'gos'], 'correct' => 1],
            ['texte' => 'Quel est le participe passé de "see" ?', 'reponses' => ['saw', 'seed', 'seen', 'seeing'], 'correct' => 2],
            ['texte' => 'Quel est le prétérit de "take" ?', 'reponses' => ['taked', 'token', 'took', 'taking'], 'correct' => 2],
            ['texte' => 'Quel est le prétérit de "come" ?', 'reponses' => ['comed', 'came', 'comen', 'coming'], 'correct' => 1],
            ['texte' => 'Quel est le participe passé de "do" ?', 'reponses' => ['did', 'doed', 'done', 'doing'], 'correct' => 2],
            ['texte' => 'Quel est le prétérit de "make" ?', 'reponses' => ['maked', 'making', 'made', 'maken'], 'correct' => 2],
            ['texte' => 'Quel est le prétérit de "have" ?', 'reponses' => ['haved', 'has', 'having', 'had'], 'correct' => 3],
            ['texte' => 'Quel est le participe passé de "be" ?', 'reponses' => ['was', 'been', 'being', 'beed'], 'correct' => 1],
            ['texte' => 'Quel est le prétérit de "say" ?', 'reponses' => ['sayed', 'said', 'saying', 'says'], 'correct' => 1],
            ['texte' => 'Quel est le participe passé de "get" ?', 'reponses' => ['getted', 'gat', 'got/gotten', 'getting'], 'correct' => 2],
        ];

        foreach ($questions as $i => $q) {
            $question = Question::create([
                'texte' => $q['texte'], 'ordre' => $i, 'quiz_id' => $quiz1->id,
            ]);
            foreach ($q['reponses'] as $j => $texte) {
                Reponse::create([
                    'texte' => $texte, 'is_correct' => $j === $q['correct'], 'question_id' => $question->id,
                ]);
            }
        }

        // --- CHAPITRE 3 ---
        $ch3 = Chapitre::create([
            'titre' => 'Méthodes de mémorisation',
            'description' => 'Techniques pour retenir les verbes irréguliers efficacement.',
            'ordre' => 3, 'formation_id' => $formation->id,
        ]);

        $sc31 = SousChapitre::create([
            'titre' => 'Techniques de mémorisation',
            'contenu' => '<h2>Comment retenir les verbes irréguliers ?</h2><h3>1. Regrouper par similarité</h3><p>Certains verbes suivent le même pattern :</p><ul><li><strong>Pattern -ought</strong> : think→thought, buy→bought, bring→brought</li><li><strong>Même forme partout</strong> : put→put→put, cut→cut→cut</li><li><strong>Changement de voyelle</strong> : sing→sang→sung, drink→drank→drunk</li></ul><h3>2. La répétition espacée</h3><p>Révisez les verbes à intervalles croissants : après 1 jour, 3 jours, 1 semaine, 2 semaines.</p><h3>3. Les utiliser en contexte</h3><p>Écrivez des phrases avec chaque verbe. Par exemple : <em>"Yesterday I <strong>went</strong> to the store and <strong>bought</strong> some milk."</em></p>',
            'ordre' => 1, 'chapitre_id' => $ch3->id,
        ]);

        // Quiz chapitre 3
        $quiz2 = Quiz::create([
            'titre' => 'Quiz : Mémorisation et patterns',
            'description' => 'Vérifiez que vous connaissez les patterns de verbes irréguliers.',
            'sous_chapitre_id' => $sc31->id,
        ]);

        $q2questions = [
            ['texte' => 'Quel verbe suit le même pattern que "think → thought" ?', 'reponses' => ['go', 'buy', 'see', 'come'], 'correct' => 1],
            ['texte' => 'Quel verbe a la même forme à tous les temps ?', 'reponses' => ['go', 'put', 'see', 'take'], 'correct' => 1],
            ['texte' => 'Quel est le prétérit de "bring" ?', 'reponses' => ['bringed', 'brought', 'brung', 'brang'], 'correct' => 1],
            ['texte' => 'Quel pattern suit "sing → sang → sung" ?', 'reponses' => ['Changement de voyelle', 'Ajout de -ed', 'Même forme', 'Ajout de -t'], 'correct' => 0],
            ['texte' => 'Quelle technique aide le plus à retenir ?', 'reponses' => ['Lire une fois', 'Répétition espacée', 'Ignorer', 'Traduire mot à mot'], 'correct' => 1],
        ];

        foreach ($q2questions as $i => $q) {
            $question = Question::create([
                'texte' => $q['texte'], 'ordre' => $i, 'quiz_id' => $quiz2->id,
            ]);
            foreach ($q['reponses'] as $j => $texte) {
                Reponse::create([
                    'texte' => $texte, 'is_correct' => $j === $q['correct'], 'question_id' => $question->id,
                ]);
            }
        }

        // ===== NOTES DE DÉMO =====
        Note::create(['user_id' => $apprenant1->id, 'formation_id' => $formation->id, 'note' => 15.50, 'commentaire' => 'Bon travail, continue !']);
        Note::create(['user_id' => $apprenant2->id, 'formation_id' => $formation->id, 'note' => 12.00, 'commentaire' => 'Peut mieux faire.']);
        Note::create(['user_id' => $apprenant3->id, 'formation_id' => $formation->id, 'note' => 8.50, 'commentaire' => 'Révisions nécessaires.']);

        // ===== RÉSULTATS QUIZ DE DÉMO =====
        QuizResult::create(['user_id' => $apprenant1->id, 'quiz_id' => $quiz1->id, 'score' => 8, 'total' => 10, 'completed_at' => now()]);
        QuizResult::create(['user_id' => $apprenant2->id, 'quiz_id' => $quiz1->id, 'score' => 6, 'total' => 10, 'completed_at' => now()]);
    }
}