document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('formServico').addEventListener('submit', function(event) {
        event.preventDefault(); // Impede o envio tradicional do formulário
        salvarServico(); // Chama a função que faz a requisição fetch
    });
});

function salvarServico() {
    const formData = {
        nome: document.getElementById('nome').value,
        cpf: document.getElementById('cpf').value,
        email: document.getElementById('email').value,
        celular: document.getElementById('celular').value,
        endereco: document.getElementById('cep').value,
        senha: document.getElementById('senha') ? document.getElementById('senha').value : '', 
        categoria: document.getElementById('categoria') ? document.getElementById('categoria').value : '', 
        descricao: document.getElementById('descricao').value,
        informacoesComplementares: document.getElementById('informacoesComplementares').value
    };

    fetch('http://localhost:8000/controller/servico', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)

    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            alert(data.message);
        } else {
            alert('Empresa salva com sucesso!');
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        alert('Ocorreu um erro ao salvar a empresa.');
    });
}
