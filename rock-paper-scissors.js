const getUserChoice = userInput => {
  userInput = userInput.toLowerCase();
  if( userInput == 'rock' || userInput == 'paper' || userInput == 'scissors' || userInput == 'bomb'  ){
		return userInput;
  }else{
    
    console.log('error message');
  }
}
const getComputerChoice  = () => {
  
  let computerInput = Math.floor(Math.random() * 3);
 
  switch(computerInput){
    case 0:
      return 'rock';
    case 1:
      return 'paper';
    case 2:
      return 'scissors';
         
  }
}

const determineWinner = (userChoice, computerChoice) => {
  if(userChoice === 'bomb') return "User Won";
  //tied game
  if(userChoice === computerChoice) return "game tied";
  //if rock
  if(userChoice ==='rock'){
    if(computerChoice === 'paper'){
       return "Computer Won";
     }else{
       return "User Won";
     }  
  }
  
  if(userChoice ==='paper'){
    if(computerChoice === 'scissors' ){
       return "Computer Won";
     }else{
       return "User Won";
     }  
  }
  
   if(userChoice ==='scissors'){
    if(computerChoice === 'rock' ){
       return "Computer Won";
     }else{
       return "User Won";
     }  
  }
}


function playGame(){
  userChoice = getUserChoice('scissors');
  computerChoice = getComputerChoice();
  
  console.log('user=' + userChoice);
  console.log('CPU=' + computerChoice);
  
  console.log(determineWinner(userChoice,computerChoice));
  
}

playGame();
