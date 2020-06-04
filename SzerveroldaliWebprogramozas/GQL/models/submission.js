'use strict';
module.exports = (sequelize, DataTypes) => {
  const Submission = sequelize.define('Submission', {
    type: {
      type: DataTypes.ENUM,
      values: ['REPL', 'TASK'],
      allowNull: false,
    },
    code: {
      type: DataTypes.STRING,
      allowNull: false,
    },
    in_data: {
      type: DataTypes.STRING,
      allowNull: false,
    },
    out_data: {
      type: DataTypes.STRING,
      allowNull: false,
    },
  }, {});
  Submission.associate = function(models) {
    // associations can be defined here
    Submission.belongsTo(models.Task)
  };
  return Submission;
};