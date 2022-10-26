import Banner from '../../components/Banner/Banner';
import Exercises from '../../components/Exercises/Exercises';
import './home.css';

export default function Home() {
  return (
    <main className='home'>
      <Banner />
      <Exercises />
    </main>
  );
}
