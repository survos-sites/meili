import { startStimulusApp } from '@symfony/stimulus-bundle';
import RevealController from '@stimulus-components/reveal'

const app = startStimulusApp();

app.debug = false;
app.register('reveal', RevealController)
