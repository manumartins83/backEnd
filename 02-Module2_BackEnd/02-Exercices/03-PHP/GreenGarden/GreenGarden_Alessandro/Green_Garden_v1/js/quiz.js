/**Initialiser le score à zéro
Initialiser un tableau avec toutes les questions et les réponses correctes

Pour chaque question dans le tableau
    Afficher la question en bas de la page
    Attendre que l'utilisateur réponde à la question
    Comparer la réponse de l'utilisateur avec la réponse correcte
    Si la réponse est correcte
        Ajouter un au score
        Afficher un message de succès
    Sinon
        Afficher un message d'échec

Après que l'utilisateur a répondu à toutes les questions
    Afficher le score total de l'utilisateur
 */

// Initialiser le score à zéro

// Initialiser un tableau avec toutes les questions et les réponses correctes
// Initialisation du quiz et du score

const quiz = [
  {
    question: "Quel est votre niveau de connaissance en jardinage ?",
    answers: ["Débutant", "Intermédiaire", "Expert"],
    correctAnswer: "Débutant"
  },
  {
    question: "Combien de temps pouvez-vous consacrer au jardinage chaque semaine ?",
    answers: ["Moins d'une heure", "Entre 1 et 3 heures", "Plus de 3 heures"],
    correctAnswer: "Entre 1 et 3 heures"
  },
  {
    question: "Quel est votre type de plante préféré ?",
    answers: ["Les plantes d'intérieur", "Les plantes d'extérieur", "Les plantes comestibles"],
    correctAnswer: "Les plantes d'intérieur"
  },
  {
    question: "Quelle est votre principale motivation pour le jardinage ?", answers: ["Décorer mon intérieur", "Manger mes propres légumes", "Me détendre"],
    correctAnswer: "Me détendre"
  },
  {
    question: "Quelle est votre plus grande difficulté en jardinage ?", answers: ["Je n'ai pas la main verte", "Je n'ai pas assez de temps", "Je n'ai pas assez d'espace", "Difficultés à choisir les bonnes plantes"],
    correctAnswer: "Je n'ai pas assez d'espace"
  },
];

let score = 0;
let currentQuestionIndex = 0;

// Sélection des éléments HTML
const startQuizButton = document.getElementById('startQuizButton');
startQuizButton.addEventListener('click', startQuiz);
const questionElement = document.getElementById("question");
const answersContainer = document.getElementById("quiz_form");
const submitButton = document.getElementById("submit");

function loadQuestion(questionIndex) {
  // Obtention de la question actuelle
  const currentQuestion = quiz[questionIndex];

  // Effacement des réponses précédentes
  answersContainer.innerHTML = "";

  // Affichage de la question et des réponses
  questionElement.textContent = currentQuestion.question;
  for (let i = 0; i < currentQuestion.answers.length; i++) {
    let answer = document.createElement("input");
    answer.textContent = currentQuestion.answers[i];
    answer.type = "radio";
    answer.name = "answer";
    answer.id = "answer" + i;
    answer.value = i;

    let label = document.createElement("label");
    label.textContent = currentQuestion.answers[i];
    label.htmlFor = "answer" + i;

    answersContainer.appendChild(label);
    answersContainer.appendChild(answer);
  }
}

function checkAnswer(answerIndex) {
  // Vérification si la réponse est correcte
  if (quiz[currentQuestionIndex].answers[answerIndex] === quiz[currentQuestionIndex].correctAnswer) {
    score++;
    alert('Correct!');
  } else {
    alert('Désolé, ce n\' est pas la bonne réponse.');
  }
}

function startQuiz() {

  // Masquer le bouton de démarrage du quiz
  startQuizButton.style.display = "none";

  // Montrer le bouton de soumission et la première question
  submitButton.style.display = "block";
  questionElement.style.display = "block";
  answersContainer.style.display = "block";

  // Charger la première question
  loadQuestion(currentQuestionIndex);

  // Ajout d'un écouteur d'événements au bouton de soumission
  submitButton.addEventListener('click', () => {
    const selectedAnswer = document.querySelector('input[type=radio]:checked');
    if (!selectedAnswer) {
      alert('Veuillez sélectionner une réponse.');
      return;
    }

    checkAnswer(Number(selectedAnswer.value));

    // Effacer la réponse sélectionnée pour la prochaine question
    selectedAnswer.checked = false;

    // Passage à la question suivante ou fin du quiz
    currentQuestionIndex++;
    if (currentQuestionIndex < quiz.length) {
      loadQuestion(currentQuestionIndex);
    } else {
      alert(`Le quiz est terminé ! Votre score est de ${score}/${quiz.length}.`);
      // Cache le quiz et montre le bouton de démarrage à nouveau
      submitButton.style.display = "none";
      answersContainer.style.display = "none";
      questionElement.style.display = "none";
      startQuizButton.style.display = "block";
      // Réinitialiser l'index de la question et le score pour le prochain démarrage du quiz
      currentQuestionIndex = 0;
      score = 0;

      //Charge la premiere question du prochain quiz
      loadQuestion(currentQuestionIndex);
    }
  });
}
