const Sequelize = require('sequelize')
// Adatbázis connection stringgel, a db.sqlite fájlban fog létrejönni
// DB Browser for SQLite programmal is lehet debugolni közben
const sequelize = new Sequelize('sqlite://db.sqlite')

const Track = sequelize.define('track', {
    // attributes
    name: {
        type: Sequelize.STRING,
        allowNull: false,
    },
    color: {
        type: Sequelize.STRING,
        defaultValue: '#fff',
        allowNull: false,
    }
}, {
    // options
});

module.exports = Track