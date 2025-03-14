import { useState , useEffect } from "react";

const App = () => {

    const [recettes, setRecettes] = useState([]);
    useEffect(() => {
        fetch(import.meta.env.VITE_URL_API)  // Lien sur le fichier .env
            .then(function(reponse){
            return reponse.json()
        })
        .then(function(data){
            setRecettes(data);
        })
    }, [])

  return <div className="container">
    <h1>Mes supers recettes</h1>
    {recettes.map(recette => (
        <article key={recette.id}>
            <h2>{recette.nom}</h2>
            <img src={recette.image} alt=""/>
            <p>Prix : {recette.prix} euro</p>
            <h3>Ingredients de la recette :</h3>
            <ul>
                {recette.ingredients.map((ingredient, key) => {
                    return <li key={key}>{ingredient}</li>
                })}
            </ul>
        </article>
    ))}
  </div> ;
}

export default App;