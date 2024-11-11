async function obtenerPhp() {
      // 👇 URL to your data location
      new Promise((resolve, reject) => {
            fetch("http://localhost:3000/src/funcionalidades/recuperarDatos.php") 
            .then(response => response.json())
            .then(data => {
                  console.log(data);
                  
                resolve(data); // Aquí data es el objeto JavaScript parseado
            })
            .catch(error => console.error('Error:', error));
      })
}

console.log(obtenerPhp());