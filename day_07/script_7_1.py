import statistics

data_input = '16,1,2,0,4,2,7,1,2,14'

data_list = list(map(int, data_input.split(",")))

def calc_fuel( data_list, position ):
    
    fuel = 0
    for data in data_list:
        fuel += abs( data - position )
        
    return fuel
    
position = round(statistics.median(data_list))
print( position )    

fuel = calc_fuel( data_list, position )
print( fuel )
