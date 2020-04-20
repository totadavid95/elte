const express = require('express');

const app = express();

app.use((request, response, next) => {
    console.log(`Ido: ${(new Date()).toString()}, IP: ${request.ip}`)
    next();
});

app.get('/', (request, response) => {
    //console.log(request.query.name);
    const name = request.query.name;
    response.json({ 'message': `Hello ${name}!` });

});

app.get('/up/:name', (request, response) => {
    //console.log(request.query.name);
    /*const name = request.query.name;
    response.json({ 'message': `Hello ${name}!` });*/
    const name = request.params.name;
    response.json({ 'message': `Hello ${name}!` });

});

app.listen(4000);