const Track = require('./models/track')

async function start() {
    await Track.sync(/*{ force: true }*/)

    await Track.create({
        name: 'First track',
        color: 'white'
    })

    const tracks = await Track.findAll()
    console.log(tracks)
}

start()