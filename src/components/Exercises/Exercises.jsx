import Cards from './Cards/Cards';
import './exercises.css';

export default function Exercises() {
  return (
    <section className='card-section'>
      <h1 className='section-title'>Pending exercises</h1>
      <Cards />
      <button className='button'>View all exercises</button>
    </section>
  );
}
