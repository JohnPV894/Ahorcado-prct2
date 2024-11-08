function obtenerPhp() {
      // 👇 URL to your data location
      fetch("http://localhost:3000/src/funcionalidades/bd.php") 
      .then((res) => res.json())
      .then((data) => {
          const result = document.getElementById("result");
          result.textContent = JSON.stringify(data);
          console.log(JSON.stringify(data));
          
});
}
obtenerPhp();