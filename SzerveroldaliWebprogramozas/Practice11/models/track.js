'use strict';
module.exports = (sequelize, DataTypes) => {
  const track = sequelize.define('track', {
    name: {
        type: DataTypes.STRING,
        allowNull: false,
    },
    color: {
        type: DataTypes.STRING,
        defaultValue: '#fff',
        allowNull: false,
    }
  }, {});
  track.associate = function(models) {
    // associations can be defined here
    track.belongsTo(models.user)    // track.setUser(), track.getUser()
  };
  return track;
};