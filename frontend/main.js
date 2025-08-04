let obj = {
  name: 'igor',
  age: 4,
};

obj = JSON.stringify(obj);

fetch('http://localhost:8001/test.php', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
  },
  body: obj,
})
.then(result => result.json())
.then(result => console.log(result))