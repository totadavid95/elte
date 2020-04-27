const express = require('express')
const tracksRouter = require('./routes/tracks')
const Track = require('./models/track')

const app = express()

app.use(express.json())

app.use('/tracks', tracksRouter)

/*

// ilyet ne, állapotmentességet sérti, és el is veszik újraindításnál

let counter = 0

app.get('/test', (req, res) => {
    res.send({ counter })
})

app.post('/test', (req, res) => {
    counter++
    res.send('Ok')
})

*/

async function start() {
    await Track.sync()
    const port = process.env.PORT || 3000
    app.listen(port, () =>
        console.log(`Server running on ${port}`)
    )
}

start()


