export function buscarEndereco() {
    const cep = document.getElementById('cep').value.replace(/\D/g, '');
    const loader = document.getElementById('cep-loader');

    if (cep.length !== 8) return;

    loader.style.display = 'block';

    // Limpa os campos antes de buscar
    document.getElementById('street').value = '';
    document.getElementById('neighborhood').value = '';
    document.getElementById('city').value = '';
    document.getElementById('state').value = '';

    fetch(`/buscar-cep/${cep}`)
        .then(response => {
            if (!response.ok) throw new Error('CEP não encontrado');
            return response.json();
        })
        .then(data => {
            loader.style.display = 'none';

            document.getElementById('street').value = data.logradouro || '';
            document.getElementById('neighborhood').value = data.bairro || '';
            document.getElementById('city').value = data.localidade || '';
            document.getElementById('state').value = data.uf || '';
        })
        .catch(() => {
            loader.style.display = 'none';
            alert('Erro ao buscar o CEP. Verifique se digitou corretamente.');
        });
}
