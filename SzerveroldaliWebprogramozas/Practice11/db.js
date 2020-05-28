const models = require('./models')
const Track = require('./models').track
const User = require('./models').user

async function start() {
    await models.sequelize.sync({ force: true })

    const track1 = await Track.create({ name: 'track1', color: 'white' })
    const track2 = await Track.create({ name: 'track2', color: 'yellow' })

    const user1 = await User.create({ username: 'user1', password: 'p' })

    await user1.setTracks([track1, track2])

    await user1.removeTrack(track1)

    //await track1.setUser(user1)

    //await track1.removeUser()  nincs
    //await track1.setUser(null)

}

start()