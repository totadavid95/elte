const express = require('express')
//const asyncHandler = require('express-async-handler')
const router = express.Router()
const Track = require('../models').track
const asyncErrors = require('express-async-errors')
const NotFoundError = require('../errors/notfound')

/*

    Végpontok megtervezése

    GET         /tracks         - Trackek lekérése
    GET         /tracks/:id     - Egy adott track lekérése
    POST        /tracks         - Új track hozzáadása
    PUT         /tracks/:id     - Csere
    PATCH       /tracks/:id     - Módosítás
    DELETE      /tracks         - Mind törlése
    DELETE      /tracks/:id     - Egy adott track törlése

    /tracks/?userId=1
*/

router
    // az összes track lekérése
    .get('/', async (req, res) => {
        const userId = req.query.userId
        //console.log(userId)
        const tracks = userId
            ? await Track.findAll({ where: { userId: userId }})
            : await Track.findAll()
        res.send(tracks)

        //const tracks =

        //const tracks = await Track.findAll()
        //res.send(tracks)
    })

    // egy adott track lekérése
    .get('/:id', async (req, res) => {
        const id = req.params.id
        //console.log('id: ' + id)
        //res.send('One track')
        const track = await Track.findOne({ where: { id: id } })
        //console.log(track)

        //throw new Error('Yaaaay')

        if (!track) {
            throw new NotFoundError('Track not found')
        }
        res.status(200).send(track)
        //res.send(track ? track : 404)
    })

    // új track hozzáadása
    .post('/', async (req, res) => {
        const reqTrack = req.body
        const newTrack = await Track.create(reqTrack)
        res.send(newTrack)
    })

    // Meglevő track frissítése
    // A put egy teljes tracket vár, kvázi egy csere,
    // míg a patch-nek elég a track egy része is
    .put('/:id', async (req, res) => {
        const id = req.params.id
        const reqTrack = req.body
        const newTrack = await Track.update(reqTrack, { where: { id: id } })
        res.send(newTrack)
    })

    .patch('/:id', async (req, res) => {
        const id = req.params.id
        const newContent = req.body
        const newTrack = await Track.update(newContent, { where: { id: id } })
        res.send(newTrack)
    })

    // mindegyik track törlése
    .delete('/', async (req, res) => {
        await Track.destroy({ truncate: true })
        res.send(204)
    })

    // egy adott track törlése
    .delete('/:id', async (req, res) => {
        const id = req.params.id
        await Track.destroy({ where: { id: id } })
        res.send(204)
    })


module.exports = router