const check = document.getElementById('check')
const phrase = document.querySelector('.phrase')
const commande = document.querySelector('.commandeId')
const commandeId = parseInt(commande.innerHTML)


check.addEventListener('change', async () => {
     if (check.checked) {
          phrase.innerHTML = "Commande effectuée"
     }
     else phrase.innerHTML = `Commande non effectuée`
     console.log(check.checked)
     const response = await sendData(`${check.checked}`)
     console.log(response)
})


async function sendData (valeur)
{
     const response = await fetch('http://localhost:8000/api/commandes/update', {
          method: 'POST', 
          headers: {
               'Content-Type' : 'application/json',
               'autorisation': 'message', 
          },
          body: JSON.stringify({
               id: `${commandeId}`,
               valeur: `${valeur}`
          })
     })
     if (response.ok) {
          const result = await response.json()
          return result
     }
     else {
          throw new Error('Erreur')
     }
}