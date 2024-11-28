// Função para carregar os serviços da API

async function carregarServicos() {
    try {
        const response = await fetch('http://localhost:8000/controller/prestadores'); // Substitua pela URL da sua API
        if (!response.ok) throw new Error('Erro ao carregar serviços');
        const servicos = await response.json();
        exibirServicos(servicos);
    } catch (error) {
        console.error('Erro ao carregar os serviços:', error);
        alert('Não foi possível carregar os serviços.');
    }
}

// Função para exibir os serviços dinamicamente
function exibirServicos(servicos) {
    const listaDeServicos = document.getElementById('listaDeServicos');
    listaDeServicos.innerHTML = ''; // Limpa a lista antes de popular

    servicos.forEach(servico => {
        const cartao = document.createElement('div');
        cartao.className = 'cartaoDeServico';
        cartao.innerHTML = `
            <h2>${servico.Descricao}</h2>
            <p><strong>Empresa:</strong> ${servico.Email}</p>
            <p><strong>Categoria:</strong> ${servico.InfoComplementares}</p>
           
        `;
        listaDeServicos.appendChild(cartao);
    });
}

// Função para abrir o modal de detalhes
function abrirModal(descricao, nome, categoria, detalhes) {
    document.getElementById('tituloModal').innerText = descricao;
    document.getElementById('empresaModal').innerText = nome;
    document.getElementById('categoriaModal').innerText = categoria;
    document.getElementById('detalhesModal').innerText = detalhes;
    document.getElementById('modalDetalhes').style.display = 'block';
}

// Função para fechar o modal de detalhes
function fecharModal() {
    document.getElementById('modalDetalhes').style.display = 'none';
}

// Carregar os serviços ao inicializar a página
document.addEventListener('DOMContentLoaded', () => {
    carregarServicos();
});
