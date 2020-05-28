const express = require('express')
const Track = require('../models').track
const User = require('../models').user

const router = express.Router()

// tracks/?userId=1
// users/1/tracks

router
    .post('/:userId/tracks', async(req, res) => {//  /users/id/tracks...
        const userId = req.params.userId
        const track = req.body

        const user = await User.findOne({ where: { id: userId }})
        const newTrack = await Track.create(track)
        await newTrack.setUser(user)

        res.send(newTrack)
    })

module.exports = router