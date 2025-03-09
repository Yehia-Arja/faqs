const pages = {};

pages.baseUrl = "http://localhost/faqs/article-server/connection/user/v1/APIs/";

pages.loadFor = (page) => {
    eval(`pages.page${page}()`);
}
class Question {
    constructor(question, answer) {
        this.question = question;
        this.answer = answer;
    }

    displayQuestionCard() {
        return `<div class="card">
                        <div class="front">
                            <p class="label">Question</p>
                            <p class="front-content">${this.question}</p>
                        </div>
                        <div class="back">
                            <p class="label">Answer</p>
                            <p class="back-content">${this.answer}</p>
                        </div>
                </div>`
    }
}


pages.pageHome = async () => {
    console.log('im here');
    
    try {
        const response = await axios.get(`${pages.baseUrl}getQuestions.php`);
        console.log(response.data);
        console.log(response.data.message);
        response.data.message.forEach(q => {

            const question = new Question (q.question, q.answer);
            document.querySelector('.card-container').innerHTML += question.displayQuestionCard();           
        });
    } catch (error) {
        console.error('Error: ', error);
    }
    
    
    
}