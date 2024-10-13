import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faUserPlus} from '@fortawesome/free-solid-svg-icons';
import femaleProfile from '../assets/avatar.png'
import maleProfile from '../assets/man.png'



const Found = ({ rfidTag, status }) => {
  return (
    <div style={style.BoxWrapper}>
      <h1>RFID TAG SCANNER</h1>
      <div style={style.BoxCenter}>
        <div style={style.BoxCenterTagStatus}>
          <h1 style={style.TextColors}>RFID TAG: <span style={{fontWeight:600, fontSize: 40}}>{rfidTag}</span></h1>
          <h2 style={style.TextColors}>Status: <span style={{fontWeight:600, fontSize: 30}}>{status}</span></h2>
        </div>
        <div style={style.ProfileBox}>
          <img src={maleProfile} width={150}/>
          <h3 style={{color: 'green', fontWeight:600}}>Found A User</h3>
        </div>
      </div>
    </div>
  );
}

const style = {
  BoxWrapper: {
    display: 'flex',
    flexDirection: 'column',
    gap: 50,
    flex: 1,
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
    // boxShadow: "box-shadow: 11px 17px 33px 0px rgba(0,0,0,0.2),0px 10px 15px -3px rgba(0,0,0,0.1);"
  },

  BoxCenterTagStatus:{
    display: 'flex',
    flexDirection: 'column',
    height: '100%',
    justifyContent: 'center',
    gap:40
  },

  TextColors:{
    color:'#0064ab',
    fontWeight: 'normal',
  },

  ProfileBox:{
    display: 'flex',
    flexDirection: 'column',
    alignItems: 'center',
    justifyContent: 'center',
    gap: 10
  }
};

export default Found;
