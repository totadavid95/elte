const express = require('express')
const asyncHandler = require('express-async-handler')
const router = express.Router()
const Track = require('../models/track')

/*

    Végpontok megtervezése

    GET         /tracks         - Trackek lekérése
    GET         /tracks/:id     - Egy adott track lekérése
    POST        /tracks         - Új track hozzáadása
    PUT         /tracks/:id     - Csere
    PATCH       /tracks/:id     - Módosítás
    DELETE      /tracks         - Mind törlése
    DELETE      /tracks/:id     - Egy adott track törlése

*/

router
    // az összes track lekérése
    .get('/', asyncHandler(async (req, res) => {
        const tracks = await Track.findAll()
        res.send(tracks)
    }))

    // egy adott track lekérése
    .get('/:id', asyncHandler(async (req, res) => {
        const id = req.params.id
        //console.log('id: ' + id)
        //res.send('One track')
        const track = await Track.findOne({ where: { id: id } })
        //console.log(track)
        res.send(track ? track : 404)
    }))

    // új track hozzáadása
    .post('/', asyncHandler(async (req, res) => {
        const reqTrack = req.body
        const newTrack = await Track.create(reqTrack)
        res.send(newTrack)
    }))

    // Meglevő track frissítése
    // A put egy teljes tracket vár, kvázi egy csere,
    // míg a patch-nek elég a track egy része is
    .put('/:id', asyncHandler(async (req, res) => {
        const id = req.params.id
        const reqTrack = req.body
        const newTrack = await Track.update(reqTrack, { where: { id: id } })
        res.send(newTrack)
    }))

    .patch('/:id', asyncHandler(async (req, res) => {
        const id = req.params.id
        const newContent = req.body
        const newTrack = await Track.update(newContent, { where: { id: id } })
        res.send(newTrack)
    }))

    // mindegyik track törlése
    .delete('/', asyncHandler(async (req, res) => {
        await Track.destroy({ truncate: true })
        res.send(204)
    }))

    // egy adott track törlése
    .delete('/:id', asyncHandler(async (req, res) => {
        const id = req.params.id
        await Track.destroy({ where: { id: id } })
        res.send(204)
    }))


module.exports = router