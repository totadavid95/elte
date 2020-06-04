'use strict';
module.exports = (sequelize, DataTypes) => {
  const Task = sequelize.define('Task', {
    title: {
      type: DataTypes.STRING,
      allowNull: false,
    },
    description: {
      type: DataTypes.STRING,
      allowNull: false,
    },
    difficulty: {
      type: DataTypes.INTEGER,
      allowNull: false,
    },
    mem_limit: {
      type: DataTypes.INTEGER,
      allowNull: false,
    },
    time_limit: {
      type: DataTypes.FLOAT,
      allowNull: false,
    },
    public: {
      type: DataTypes.BOOLEAN,
      allowNull: false,
    },
  }, {});
  Task.associate = function(models) {
    // associations can be defined here
    Task.hasMany(models.Submission)
  };
  return Task;
};
