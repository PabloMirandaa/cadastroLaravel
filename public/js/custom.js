// Receber o seletor do campo valor
let inputValor = document.getElementById('valor');

// Aguardar o usuário digitar valor no campo
inputValor.addEventListener('input', function(){

    // obtero valor atual removendo qualquer caractere que não seja número
    let valueValor = this.value.replace(/[^\d]/g, '');

    // adicionar os speradores de milhares 
    var formattedValor = (valueValor.slice(0,-2).replace(/\B(?=(\d{3})+(?!\d))/g,'.')) + '' + valueValor.slice(-2);

    // adicionar a vírgula em até dois digitos se houver centavos
    formattedValor = formattedValor.slice(0,-2) + ',' + formattedValor.slice(-2);

    // atualizar o valor do campo
    this.value = formattedValor;
})

function confirmarExclusao(event, contaId){

    event.preventDefault();

    Swal.fire({
        title:'Tem certeza?',
        text:'Essa ação não poderá ser desfeita!',
        icon:'warning',
        showCancelButton:true,
        cancelButtonColor:'#d33',
        cancelButtonText:'Cancelar',
        confirmButtonColor:'#3085d6',
        confirmButtonText:'Sim, excluir',
    }).then((result)=>{
        if(result.isConfirmed){
            document.getElementById(`formExcluir${contaId}`).submit();
        }
    })
}

