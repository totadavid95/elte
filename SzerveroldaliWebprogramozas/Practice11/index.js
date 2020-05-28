const express = require('express')
const tracksRouter = require('./routes/tracks')
const usersRouter = require('./routes/users')
const authRouter = require('./routes/auth')
//const Track = require('./models/track')
const models = require('./models')
const NotFoundError = require('./errors/notfound')
const HttpStatus = require('http-status-codes');
const jwtMiddleware = require('express-jwt')

const app = express()

app.use(express.json())

app.use('/users', usersRouter)

app.use('/tracks', jwtMiddleware({ secret: 'titkos' }), tracksRouter)

app.use('/auth', authRouter)

app.use((err, req, res, next) => {
    if (err instanceof NotFoundError) {
        return res
                .status(HttpStatus.NOT_FOUND)
                .send({
                    type: err.name,
                    httpStatus: HttpStatus.getStatusText(HttpStatus.NOT_FOUND),
                    message: err.message,
                })
    }
    next(err)
})

app.use(function errorHandler (err, req, res, next) {
    if (res.headersSent) {
        return next(err)
    }
    res
        .status(HttpStatus.INTERNAL_SERVER_ERROR)
        //.render('error', { error: err })
        .send({
            type: err.name,
            httpStatus: HttpStatus.getStatusText(HttpStatus.NOT_FOUND),
            message: err.message,
        })
})

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
    //await Track.sync()
    await models.sequelize.sync()
    const port = process.env.PORT || 3000
    app.listen(port, () =>
        console.log(`Server running on ${port}`)
    )
}

start()


