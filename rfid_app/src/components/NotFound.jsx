import React from 'react'
import notFoundPic from '../assets/cancel.png'
const NotFound = ({ rfidTag, status }) => {
  return (
    <div style={style.BoxWrapper}>
      <h1>RFID TAG SCANNER</h1>
      <div style={style.BoxCenter}>
        <div style={style.BoxCenterTagStatus}>
          <h1 style={style.TextColors}>RFID TAG: <span>{rfidTag}</span></h1>
          <h2 style={style.TextColors}>Status: <span>{status}</span></h2>
        </div>
        <div>
          <img src={notFoundPic} width={120}/>
        </div>
      </div>
    </div>
  )
}


const style = {
  BoxWrapper: {
    gap: 50,
    display: 'flex',
    flexDirection: 'column',
    height: '100vh',
    backgroundColor: '#e1c0b6',
    justifyContent: 'center',
    alignItems: 'center',
  },
  BoxCenter:{
    display: 'flex',
    backgroundColor:'white',
    justifyContent: 'space-around',
    alignItems: 'center',
    width: 600,
    height: 300,
    borderRadius: 20,
    boxShadow: '0px 10px 25px rgba(0, 0, 0, 0.2)'
  },

  BoxCenterTagStatus:{
    display: 'flex',
    flexDirection: 'column',
    height: '100%',
    justifyContent: 'center',
    gap:40
  },

  TextColors:{
    color:'#0064ab'
  }

  
}

export default NotFound