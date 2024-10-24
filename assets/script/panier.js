const validation = document.getElementById('validation')
const commande = document.getElementById('form-commandes')

if (!validation) {
     commande.addEventListener('submit', (e) => {
          e.preventDefault()
          createInfo()
     })
}

function createInfo ()
{
     const container = document.createElement('div')
     const h3 = document.createElement('h3')
     const create = document.createElement('a')
     const connexion = document.createElement('a')
     const content = document.createElement('div')
     const fermeture = document.createElement('h3')
     container.classList.add('information')
     h3.innerHTML = "Vous devez être connecté(e)"
     h3.style.cssText = `
     font-size:16px;
     font-weight: 200;
     `
     fermeture.classList.add('fermeture')
     h3.classList.add('my-4')
     
     content.style.cssText = `
          width:100%;
          margin: 5px 0;
          display:flex;
          flex-direction:row;
          align-items:center;
          justify-content:space-around;
     `

     fermeture.innerHTML = "Fermer"
     fermeture.style.cursor = 'pointer'

     fermeture.addEventListener('click', () => {
          container.style.display = "none"
     })
     
     create.setAttribute('href', '/user/profil/create')
     connexion.setAttribute('href', '/login')
     create.innerHTML = 'Créer'
     connexion.innerHTML = 'Connexion'
     content.appendChild(create)
     content.appendChild(connexion)
     connexion.style.margin = "0 5px"
     create.style.margin = "0 5px"     
     container.appendChild(h3)
     container.appendChild(content)
     container.appendChild(fermeture)
     document.body.appendChild(container)
     
}