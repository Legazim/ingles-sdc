import logo from './assets/logo.svg';
import './banner.css';

export default function Banner() {
  return (
    <div>
      <section className='banner'>
        <div className='banner_content'>
          <img src={logo} className='banner_logo' />
          <div className='banner_text'>
            <p>SDC</p>
            <p>LANGUAGE SCHOOL</p>
          </div>
        </div>
        <div className='banner_gradient'></div>
      </section>
    </div>
  );
}
